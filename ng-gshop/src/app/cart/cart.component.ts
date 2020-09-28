import { Component, OnInit } from '@angular/core';
import { LocalStorageService } from '../local-storage.service'
import {Router} from "@angular/router"
import { UserService } from '../user.service'

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit {

  
  constructor( private localStorageService: LocalStorageService, private router: Router, private userService: UserService) { }

  products = [];
  amount = 0;

  ngOnInit(): void {

    this.products = this.localStorageService.get('cart') != null ? this.localStorageService.get('cart') :  products;
    this.setTotalAmount()
    
  }

  onRmvFromCart(i){
    this.products.splice(i,1);
    this.localStorageService.set('cart',this.products);
    this.setTotalAmount()
    
  }

  setTotalAmount(){
    this.amount = 0; 
    for (let product of this.products ){
      this.amount += product.price;
    }
  }

  onClickPay(){

    if( this.userService.isAuth() ){
      this.products = [];
      this.localStorageService.set('cart',this.products);
      this.router.navigate(['thankyou']);
    }else{
      this.router.navigate([''])
    }

  }


}

