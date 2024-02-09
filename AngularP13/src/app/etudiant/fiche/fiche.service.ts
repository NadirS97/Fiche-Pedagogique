import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class FicheService {

  constructor(private http: HttpClient) { }

  private _datafiche:Array<any>=[]

  
  Fiche(NumEtu:any ){
    return this.http.post('https://localhost:8000/etu/fiche',NumEtu);}
  
  supprimer(id:any ){
    return this.http.post('https://localhost:8000/etu/fiche/remove',id);}
    
    public getFiches():Array<any>{
      return this._datafiche;
    }
  }
