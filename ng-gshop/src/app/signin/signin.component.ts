import { Component, OnInit } from '@angular/core';
import { UserService } from '../user.service'
import { FormControl, FormGroup } from '@angular/forms'
import { LocalStorageService } from '../local-storage.service'
import {Router} from "@angular/router"


@Component({
  selector: 'app-signin',
  templateUrl: './signin.component.html',
  styleUrls: ['./signin.component.css']
})
export class SigninComponent implements OnInit {

  userData = [];
  error = '';
  
  constructor(private userService: UserService, private localStorage: LocalStorageService, private router: Router) { }

  signinForm = new FormGroup({
    email : new FormControl(''),
    password : new FormControl(''), 
 });


  ngOnInit(): void {

    if(this.userService.isAuth())
      this.router.navigate(['']);
        
  }


  signin(){
    
      this.userService.login(this.signinForm.value).subscribe(data => {
        this.userData = data; 
        this.error = '';
        this.localStorage.set('userData',this.userData);
        this.router.navigate(['']);
        window.location.reload();
        
      },(error) => {
        this.error = error;
        this.localStorage.remove('userData');
      });
    

  }

}
