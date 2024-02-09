import { Component, OnInit } from '@angular/core';
import { FicheATraiterService } from '../fiches-trt/fiche-a-traiter.service';
import { FicheValideService } from './fiche-valide.service';

@Component({
  selector: 'app-fiches-trs',
  templateUrl: './fiches-trs.component.html',
  styleUrls: ['./fiches-trs.component.css']
})
export class FichesTrsComponent implements OnInit {

  constructor(private fiche:FicheValideService) { }

  _fiches:Array<any>=[]
  _success:string=""
  _warning:string=""
  _error:string=""
  ngOnInit(): void {
    this.fiche.fiches(JSON.parse(localStorage.getItem('secr') || '')).subscribe(
      fiches=>{
        console.log(fiches)
        //@ts-ignore
        this._fiches=fiches
      }
    )
  }
  fermer_success(){
    window.location.reload();
    this._success="";
    this._error="";
    this._warning="";
   }

   transmettre(id:number,nomEtu:string){
    this.fiche.transmettre(id).subscribe(
      success=>{
        this._success="la fiche de { "+nomEtu+" } a bien été transmise"
      },
      error=>{
        this._error=error.error.message
      }
    );
   }
   transmis_tout(){
    this.fiche.transmettre_tous(JSON.parse(localStorage.getItem('secr') || '')).subscribe(  success=>{
      //@ts-ignore
      this._success=success.message
    },
    error=>{
      this._error=error.error.message
    })
   }

  plus(element:any,plus:any){
    
    if(element.style.display=='none'){
      plus.innerHTML='<i class="bi bi-dash" style="font-size: 18px;"></i>'
      plus.className='btn btn-warning'
      element.style.display='initial'
    }
    else{
      plus.innerHTML='<i class="bi bi-plus" style="font-size: 18px;"></i>';
      plus.className='btn btn-info'
      element.style.display='none'
    }
  }

}
