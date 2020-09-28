import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http'

@Injectable({
  providedIn: 'root'
})
export class CategoriesService {


  const httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };

  constructor(private http:HttpClient) { }

  getAll(){
    return this.http.get<any>('/api/categories/all',this.httpOptions)
  }

}
