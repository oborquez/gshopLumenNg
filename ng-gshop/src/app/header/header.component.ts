import { Component, OnInit } from '@angular/core';
import { UserService } from '../user.service'
import {Router} from "@angular/router"
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  userData = [];

  constructor(private userService : UserService, private router : Router) { }

  ngOnInit(): void {
    this.userData = this.userService.isAuth();
  }

  logout(){
    this.userService.logout();
    this.userData = [];
    this.router.navigate(['']);
    window.location.reload();
  }
}
