<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductTransactionResource\Pages;
use App\Filament\Resources\ProductTransactionResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductTransaction;
use App\Models\PromoCode;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;


// use Illuminate\Support\Facades\Log;

class ProductTransactionResource extends Resource
{
    protected static ?string $model = ProductTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Transaction';
    protected static ?string $navigationLabel = 'Orders';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return ProductTransaction::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([

                    Step::make('Product and Price')
                        ->schema([
                            
                            Grid::make(2)
                                ->schema([
                                    Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()

                                    // ini dijalankan ketika input an nya masih kosong
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        
                                        $product = Product::find($state);
                                        $price = 0;
                                        $quantity = $get('quantity') ?? 1;
                                        $subTotalAmount = $price * $quantity;

                                        $set('price', $price);
                                        $set('sub_total_amount', $subTotalAmount);

                                        $discount = $get('discount_amount') ?? 0;
                                        $grandTotalAmount = $subTotalAmount - $discount;
                                        $set('grand_total_amount', $grandTotalAmount);

                                        $sizes = $product ? $product->sizes->pluck('size', 'id')->toArray() : [];
                                        $set('product_sizes', $sizes);
                                    })

                                    // ini digunakan apabila input an nya sudah ada value nya
                                    ->afterStateHydrated(function ($state, callable $get, callable $set) {
                                        $productId = $state;
                                        if($productId) {
                                            $product = Product::find($productId);
                                            $sizes = $product ? $product->sizes->pluck('size', 'id')->toArray() : [];
                                            $set('product_sizes', $sizes);
                                        }
                                    }),

                                   Select::make('product_size')
                                    ->label('Product Size')
                                    ->options(function (callable $get) {
                                        $sizes = $get('product_sizes');
                                        return is_array($sizes) ? $sizes : [];
                                    })
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $productSize = $state;
                                        $productSizeModel = ProductSize::find($productSize);
                                        $price = $productSizeModel ? $productSizeModel->price : 0;
                                        $quantity = $get('quantity') ?? 1;
                                        $subTotalAmount = $price * $quantity;

                                        $set('price', $price);
                                        $set('sub_total_amount', $subTotalAmount);
    
                                        $discount = $get('discount_amount') ?? 0;
                                        $grandTotalAmount = $subTotalAmount - $discount;
                                        $set('grand_total_amount', $grandTotalAmount);
                                    }),

                                    TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Qty')
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        
                                        $price = $get('price');
                                        $quantity = $state;
                                        $subTotalAmount = $price * $quantity;

                                        $set('price', $price);
                                        $set('sub_total_amount', $subTotalAmount);

                                        $discount = $get('discount_amount') ?? 0;
                                        $grandTotalAmount = $subTotalAmount - $discount;
                                        $set('grand_total_amount', $grandTotalAmount);
                                    }),

                                    Select::make('promo_code_id')
                                    ->label('Promo Code')
                                    ->relationship('promoCode', 'code')
                                    ->searchable()
                                    ->preload()
                                    // ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                        $subTotalAmount = $get('sub_total_amount');
                                        $promoCode = PromoCode::find($state);
                                        $discount = $promoCode ? $promoCode->discount_amount : 0;

                                        $set('discount_amount', $discount);

                                        $grandTotalAmount = $subTotalAmount - $discount;
                                        $set('grand_total_amount', $grandTotalAmount);
                                    }),

                                    TextInput::make('sub_total_amount')
                                    ->label('Sub Total Amount')
                                    ->required()
                                    ->readOnly()
                                    ->numeric()
                                    ->prefix('IDR'),
                                    
                                    TextInput::make('grand_total_amount')
                                    ->label('Grand Total Amount')
                                    ->required()
                                    ->readOnly()
                                    ->numeric()
                                    ->prefix('IDR'),

                                    TextInput::make('discount_amount')
                                    ->label('Discount Amount')
                                    // ->required()
                                    ->readOnly()
                                    ->numeric()
                                    ->prefix('IDR'),
                                ]),
                        ]),

                    Step::make('Customer Information')
                        ->schema([

                            Grid::make(2)
                            ->schema([
                                Select::make('user_id')
                                    ->label('Customer Name')
                                    ->options(User::all()->pluck('name', 'id')) // Mengambil daftar user
                                    ->reactive() // Supaya ada efek perubahan saat user dipilih
                                    ->afterStateUpdated(function (callable $set, $state) {
                                        $user = User::find($state); // Cari user berdasarkan ID yang dipilih
                                        if ($user) {
                                            $set('email', $user->email); // Isi email berdasarkan user
                                            $set('phone', $user->phone); // Isi phone berdasarkan user
                                        } else {
                                            $set('email', null); // Kosongkan jika tidak ada user
                                            $set('phone', null); // Kosongkan jika tidak ada user
                                        }
                                    })
                                    ->required(),

                                // Input untuk phone (berubah otomatis saat user dipilih)
                                TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->disabled() // Tidak bisa diubah manual
                                    ->reactive() // Ikuti perubahan dari dropdown user
                                    ->required(),

                                // Input untuk email (berubah otomatis saat user dipilih)
                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->disabled() // Tidak bisa diubah manual
                                    ->reactive() // Ikuti perubahan dari dropdown user
                                    ->required(),

                                TextArea::make('address')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('city')
                                ->required()
                                ->maxLength(255),

                                TextInput::make('post_code')
                                ->label('Post Code')
                                ->required()
                                ->maxLength(255),
                            ]),
                        ]), 

                    Step::make('Payment Information')
                        ->schema([
                            
                            TextInput::make('booking_trx_id')
                            ->label('Booking Trx Id')
                            ->required()
                            ->maxLength(255),

                            ToggleButtons::make('is_paid')
                            ->label('Have You Paid?')
                            ->boolean()
                            ->grouped()
                            ->icons([
                                true => 'heroicon-o-pencil',
                                false => 'heroicon-o-clock'
                            ])
                            ->required(),
                        ]),
                ])

                ->columnSpan('full')
                ->columns(1)
                ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('product.thumbnail')
                //     ->label('Foto Produk'),

                TextColumn::make('booking_trx_id')
                    ->label('ID Transaksi')
                    ->searchable(),

                TextColumn::make('product.name')
                    ->label('Nama Produk')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Nama Pelanggan')
                    ->searchable(),

                // TextColumn::make('user.email')
                //     ->label('Email Pelanggan')
                //     ->searchable(),

                TextColumn::make('user.phone')
                    ->label('Nomor Handphone')
                    ->searchable(),

                IconColumn::make('is_paid')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->label('Status Pembayaran'),
            ])
            ->filters([
                SelectFilter::make('product_id')
                    ->label('product')
                    ->relationship('product', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->action(function (ProductTransaction $record) {
                        $record -> is_paid = true;
                        $record -> save();

                        Notification::make()
                            ->title('Order Approved')
                            ->success()
                            ->body('The Order has been successfully approved.')
                            ->send();
                    }) 
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (ProductTransaction $record) => !$record -> is_paid),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductTransactions::route('/'),
            'create' => Pages\CreateProductTransaction::route('/create'),
            'edit' => Pages\EditProductTransaction::route('/{record}/edit'),
        ];
    }
}
