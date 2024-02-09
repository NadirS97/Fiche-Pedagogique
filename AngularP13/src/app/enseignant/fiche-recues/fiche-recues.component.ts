import { Component, OnInit } from '@angular/core';
import { FichesRecuesService } from './fiches-recues.service';

@Component({
  selector: 'app-fiche-recues',
  templateUrl: './fiche-recues.component.html',
  styleUrls: ['./fiche-recues.component.css']
})
export class FicheRecuesComponent implements OnInit {

  constructor(private fiche:FichesRecuesService) { }

  _fiches:Array<any>=[]
  _success:string=""
  _warning:string=""
  _error:string=""
  ngOnInit(): void {
    this.fiche.fiches().subscribe(
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
  valider_RSE_ue(id:number,validite:any){
    this.fiche.valider_RSE_ue(id).subscribe(
      success=>{
        //@ts-ignore
        this._success=success.message
        validite.innerHTML="<i class=\"bi bi-check-circle-fill text-success\"></i>"
      },
      error=>{
        this._error=error.error.message
      }
    );
   
  }
  refuser_RSE_ue(id:number,validite:any){
    this.fiche.refuser_RSE_ue(id).subscribe(
      success=>{
        //@ts-ignore
        this._warning=success.message
        validite.innerHTML="<i class=\"bi bi-x-circle-fill text-danger\"></i>"
      },
      error=>{
        this._error=error.error.message
      }
    );
   
  }
  confirmer_fiche(id:number){
    this.fiche.confirmer_fiche(id).subscribe(
      success=>{
        //@ts-ignore
        this._success=success.message
      },
      error=>{
        this._error=error.error.message
      }
    );
   
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
