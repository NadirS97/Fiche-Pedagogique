import { Component, OnInit } from '@angular/core';
import { ListeService } from './liste.service';

@Component({
  selector: 'app-listes',
  templateUrl: './listes.component.html',
  styleUrls: ['./listes.component.css']
})
export class ListesComponent implements OnInit {

 
  constructor(private fiche:ListeService) { }

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
