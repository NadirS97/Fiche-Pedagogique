import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProfileService {

  constructor(private http: HttpClient) { }

  profile_data(numEtu:number){
    return this.http.get('https://localhost:8000/etu/profile/'+numEtu);}

    profile_update(numEtu:number,data:any){
      return this.http.post('https://localhost:8000/etu/profile/'+numEtu,data);}
}
