// src/products/entities/product.entity.ts
import { Entity, Column, PrimaryGeneratedColumn } from 'typeorm';

@Entity()
export class Product {
  @PrimaryGeneratedColumn('uuid') // Menggunakan UUID untuk ID agar unik
  id: string; 

  @Column({ type: 'varchar', length: 255 })
  name: string; 

  @Column({ type: 'text' })
  description: string; 

  @Column({ type: 'decimal' })
  price: number; 
}