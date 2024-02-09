import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PasswordService {

  constructor(private http: HttpClient) { }

  Modifier(data:any ){
    return this.http.post('https://localhost:8000/etu/password',data);}
}
