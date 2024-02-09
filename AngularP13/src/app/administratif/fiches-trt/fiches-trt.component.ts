import { Component, OnInit } from '@angular/core';
import { FicheATraiterService } from './fiche-a-traiter.service';

@Component({
  selector: 'app-fiches-trt',
  templateUrl: './fiches-trt.component.html',
  styleUrls: ['./fiches-trt.component.css']
})
export class FichesTrtComponent implements OnInit {

  constructor(private fiche:FicheATraiterService) { }

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
  valider(id:number,nomEtu:string){
    this.fiche.valider_fiche({id:id,Secretaire:{id:JSON.parse(localStorage.getItem('secr') || '')}}).subscribe(
      success=>{
        this._success="La fiche de { "+nomEtu+" } est bien validée et prete a etre transmise"
      },
      error=>{
        this._error=error.error.message
      }
    );
   
  }
  refuser(id:number,nomEtu:string){
    if(confirm("Est ce que vous voulez vraiment refuser la fiche de  "+nomEtu)) {
      this.fiche.refuser_fiche({id:id}).subscribe(
        success=>{
          this._warning="la fiche de { "+nomEtu+" } est bien refusée"
        },
        error=>{
          this._error=error.error.message
        }
      );
    }
   
    
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
