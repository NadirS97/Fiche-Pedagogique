import { Component, OnInit } from '@angular/core';

import {FicheService } from './fiche.service';

@Component({
  selector: 'app-fiche',
  templateUrl: './fiche.component.html',
  styleUrls: ['./fiche.component.css']
})
export class FicheComponent implements OnInit {

  constructor(private datafiche:FicheService) { }

  _data:Array<any>=[]
  _success:string=""
  _error:string=""
  supprimer(id:number){
    this.datafiche.supprimer({id:id}).subscribe(
      data=>{
        //@ts-ignore
        this._success=data.message
      },
      error=>{
        this._error=error.error.message
      }
      );
  }
  fermer_success(){
    window.location.reload();
    this._success="";
    this._error="";
   }
  plus(element:any,plus:any){
    
    if(element.style.display=='none'){
      plus.innerHTML='Moins <i class="bi bi-dash"></i>'
      plus.style.color='#E80209'
      element.style.display='initial'
    }
    else{
      plus.innerHTML='Plus <i class="bi bi-plus ml-2"></i>';
      plus.style.color='#0CBB00'
      element.style.display='none'
    }
  }
  
  ngOnInit(): void {
    const data ={
      NumEtudiant: JSON.parse(localStorage.getItem('NumEtu') || '')
    }
    this.datafiche.Fiche(data).subscribe(
      data=>{
          console.log(data);
          //@ts-ignore
          this._data=data
      
      },
      error=>{

      }
      
      );
    }
  }


