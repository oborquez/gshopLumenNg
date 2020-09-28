import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CartComponent } from './cart/cart.component';
import { ListComponent } from './list/list.component';
import { ThankyouComponent } from './thankyou/thankyou.component';
import { SigninComponent } from './signin/signin.component';


const routes: Routes = [
  
  {
    path: '',
    component : ListComponent
  },
  {
    path: 'cart',
    component : CartComponent
  },
  {
    path: 'login',
    component : CartComponent
  },
  {
    path: 'admin',
    component : CartComponent
  },
  {
    path: 'thankyou',
    component : ThankyouComponent
  },
  {
    path: 'signin',
    component: SigninComponent
  }
  

  


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
