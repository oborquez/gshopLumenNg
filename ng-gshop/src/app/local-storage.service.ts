import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class LocalStorageService {

  constructor() { }


  set(key: string, data: any){
    try{
      localStorage.setItem(key,JSON.stringify(data));
    }catch(e){
      console.log(e)
    }
  }

  get(key){

    try{
      return JSON.parse(localStorage.getItem(key))
    }catch(e){
      console.log(e)
    }    
  }

  remove(key){
    try{
      localStorage.removeItem(key)
    }catch(e){
      console.log(e)
    }  
  }

  isAuth(){
    return true;
  }

}
