// src/app.module.ts
import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { ProductsModule } from './products/products.module';
import { Product } from './products/entities/product.entity';

@Module({
  imports: [
    TypeOrmModule.forRoot({
      type: 'postgres', // Tipe database 
      host: 'localhost', // atau host database Anda
      port: 5432,
      username: 'postgres', // username database Anda
      password: '', // password database Anda
      database: 'vapebay_test', // nama database Anda
      entities: [Product],
      synchronize: true, // Untuk pengembangan, otomatis membuat skema tabel
    }),
    ProductsModule,
  ],
})
export class AppModule {}