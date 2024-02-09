import { Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormGroup } from '@angular/forms';
import {FormFicheService } from '.././form-fiche.service';

interface UeParcour{
  ue:{
    id:number
  }
  RSE:string,
  Inscription:string,
  VNote:number
};
interface Statut{
  EtudiantRSE:string;
  EtudiantAJAC:string;
  EtudiantRNE:string;
  EtudiantREDOUBLANT:string;
  EtudiantSemestreObtenu:string;
  EtudiantTiersTemps:string;
};
interface Etudiant{
  NumEtudiant:number,
  statut:Array<Statut>
};
interface data{
  Etudiant:Etudiant,
  UeParcours:Array<UeParcour>
};

@Component({
  selector: 'form-a',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.css']
})
export class FormComponent implements OnInit {

  
  _error:string=""
  _success:string="test"
  _checked_RSE!: string;
  _checked_Redoublant!: string;
  _checked_AJAC!: string;
  _checked_Temps!: string;
  _checked_INSCRIT!: string;
  _note_readonly!: boolean;
  Form: FormGroup;

  constructor(private datafiche:FormFicheService,private fb:FormBuilder) {

    this.Form = this.fb.group({
      S_RSE:'',
      S_Redoublant :'',
      S_AJAC:'',
      S_Temps:'',
      Semestre:'',
      UeParcours: this.fb.array([]) ,
    });

   }

   fermer_success(){
    this._success="";
   }
   
  disableRSE:boolean=true;
  redoublant!: boolean;
  NiveauParcours!: string;
  Parcours!: string;

  enable_RSE(){
    this.disableRSE=false;
  }
  disable_RSE(){
    this.disableRSE=true;
  }
  enable_redoublant(){
    this.redoublant=false;
  }
  disable_redoublant(){
    this.redoublant=true;
  }
  
  newUeParcours(id:string,codeapogee:string,type:string,libelle:string,ECTS:string): FormGroup {
    return this.fb.group({
      codeapogee:codeapogee,
      type:type,
      libelle:libelle,
      idUe:id,
      ECTS:ECTS,
      inscription: '',
      Note: '',
      RSE:''
    })
  }

  get UeParcours() : FormArray {
    return this.Form.get("UeParcours") as FormArray
  }
 
  addUeParcours(id:string,codeapogee:string,type:string,libelle:string,ECTS:string) {
    this.UeParcours.push(this.newUeParcours(id,codeapogee,type,libelle,ECTS));
  }
  
  
 
 
  onSubmit() {
    //console.log(this.Form.getRawValue());
    const formData = this.Form.getRawValue();
    let RSE:string="";
    let RNE:string="Oui";
    let semestre:string=""
    if(formData.S_RSE=="Oui"){
       RSE=formData.S_RSE;
       RNE="Non";
      if(formData.S_Redoublant=="Oui"){
        semestre=formData.Semestre;
      }

    }
    const status:Statut={
      EtudiantRSE:RSE,
      EtudiantAJAC:formData.S_AJAC,
      EtudiantTiersTemps:formData.S_Temps,
      EtudiantREDOUBLANT:formData.S_Redoublant,
      EtudiantSemestreObtenu:semestre,
      EtudiantRNE:RNE
    }
    const Etudiant:Etudiant={
      NumEtudiant:JSON.parse(localStorage.getItem('NumEtu') || ''),
      statut: [status]
    }
    let UeParours:Array<UeParcour>=[]
    formData.UeParcours.forEach((ue: { idUe: number; RSE: string; inscription: string; Note: number; }) => {
      let RSE_:string="Non";
      let Note:number=+ue.Note
      if(RSE=="Oui")
        if(ue.RSE)
          RSE_="Oui"
      if(ue.inscription=="Oui")
          Note=0.0
      UeParours.push(
        {
          ue:{id:+ue.idUe },
          RSE:RSE_,
          Inscription:ue.inscription,
          VNote:Note
        }
        )
    });

    const data:data={
      Etudiant:Etudiant,
      UeParcours:UeParours
    }


    
    this.datafiche.Addfiche(data).subscribe(
      sucsess=>{
        console.log(sucsess)
        //@ts-ignore
        if(sucsess.success){
          //@ts-ignore
          console .log(sucsess.message)
          //@ts-ignore
          this._success=sucsess.message
        }

      },
      error=>{
        console.log(error.message)
      }
      )

  
    
  }




  ngOnInit(): void {
    this._success=""
    const data ={
      NumEtudiant: JSON.parse(localStorage.getItem('NumEtu') || '')
    }
    this.datafiche.Ue(data).subscribe(
      data=>{
        console.log(data)
          //@ts-ignore
          this._data=data  
          //@ts-ignore
          data.ues.forEach(ue => {
            this.addUeParcours(ue.id.toString(),ue.CodeApogee,ue.Type,ue.Libelle,ue.ECTS.toString())
          });
          //@ts-ignore
          this.NiveauParcours=data.NiveauParcours
          //@ts-ignore
          this.Parcours=data.Libelle
      },
      error=>{
        this._error=error.error.message
      }
      
      );
      this._checked_RSE='Non';
      this._checked_Redoublant='Non';
      this._checked_AJAC='Non';
      this._checked_Temps='Non';
      this._checked_INSCRIT='Oui';
      this.redoublant=true;
      this._note_readonly=false;
    }

}
