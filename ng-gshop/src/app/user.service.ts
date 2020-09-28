import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http'
import { Observable,throwError } from 'rxjs';
import { catchError } from 'rxjs/operators'
import { LocalStorageService } from './local-storage.service'


@Injectable({
  providedIn: 'root'
})
export class UserService {

  userData = [];
  
  const httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };
  
  constructor(private http:HttpClient, private localStorage: LocalStorageService) { }

  login(data):Observable<any>{
    
    return this.http.post<any>('/api/user/login',data, this.httpOptions)
    .pipe(catchError(this.handleError));
  }

  isAuth(){
      this.userData = this.localStorage.get('userData') ? this.localStorage.get('userData') : false;
      return this.userData
    
  }

  handleError(error){
    return throwError(error.message || "Server Error")
  }

  logout(){
    return this.localStorage.remove('userData');
  }


}
