import { Component, OnInit } from '@angular/core';
import { ProductsService } from '../products.service';
import { CategoriesService } from '../categories.service';
import { LocalStorageService } from '../local-storage.service'
import { FormControl, FormGroup } from '@angular/forms'

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {

  constructor(private productsService: ProductsService, private categorySerice: CategoriesService, private localStorageService: LocalStorageService) {}

  products = [];
  categories = [];
  cart = []; 

  filterForm = new FormGroup({
     category : new FormControl(0),
     searchString : new FormControl(''), 
  });

  
  ngOnInit(): void {
    
    this.productsService.getAll().subscribe(data => {
      this.products = data;
    });

    this.categorySerice.getAll().subscribe(data=>{
      this.categories = data;
    })

  }

  onClickAddCart(product){
    
    this.cart = this.localStorageService.get('cart') != null ? this.localStorageService.get('cart')  : this.cart ;
    this.cart.push(product);
    this.localStorageService.set('cart',this.cart);
    console.log(this.cart);
    
  }

  onCategorySelected(e){
    
    var categoryId = e.target.value;

    this.productsService.getByCategory( categoryId ).subscribe(data => {
      
      this.products = data; 

    });
  }

  filterProducts(){
    
    this.productsService.getByFilters( this.filterForm.value ).subscribe(data => {
      
      this.products = data; 

    });

  }

  

}
