import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http'


@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  
  const httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };
  constructor(private http:HttpClient) { }
  
  getAll(){
    return this.http.get<any>('/api/products/all',this.httpOptions);
  }
  
  getByCategory( categoryId ){
    return this.http.get<any>('/api/products/'+categoryId,this.httpOptions);
  } 

  getByFilters(values){
    return this.http.post<any>('/api/products/byFilters',values, this.httpOptions);
  }

}
