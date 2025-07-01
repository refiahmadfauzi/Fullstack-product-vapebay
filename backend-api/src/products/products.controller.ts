// src/products/products.controller.ts
import { Controller, Get, Post, Body } from '@nestjs/common';
import { ProductsService } from './products.service';
import { CreateProductDto } from './dto/create-product.dto';
import { Product } from './entities/product.entity';

@Controller('api/products') // Base path untuk endpoint produk
export class ProductsController {
  constructor(private readonly productsService: ProductsService) {}

  @Post() // Mendefinisikan endpoint POST /api/products 
  create(@Body() createProductDto: CreateProductDto): Promise<Product> {
    return this.productsService.create(createProductDto);
  }

  @Get() // Mendefinisikan endpoint GET /api/products 
  findAll(): Promise<Product[]> {
    return this.productsService.findAll();
  }
}