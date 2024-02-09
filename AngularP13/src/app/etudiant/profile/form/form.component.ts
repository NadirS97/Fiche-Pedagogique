import { DatePipe, formatDate } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { ProfileService } from '../profile.service';
import { Input } from '@angular/core';

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.css']
})
export class ProfileFormComponent implements OnInit {

  //@ts-ignore
  Form: FormGroup;
  _error:string=""
  _success:string=""
  _data:any
  _parcours:string=""
  constructor(private fb:FormBuilder, private profile:ProfileService) { 
    this.Form= this.fb.group(
      {
        PrenomEtudiant:  new FormControl('', [
           Validators.required])
        ,
        NomEtudiant: new FormControl('', [
           Validators.required])
        ,
        DateNaissance: new FormControl('', [
           Validators.required])
        ,
        AdresseEtudiant: new FormControl('', [
           Validators.required])
        ,
        TelEtudiant: new FormControl('', [
           Validators.required])
        ,
        EmailEtudiant: new FormControl( '', [
           Validators.required])
        ,
        Parcours: new FormControl('')
        ,
        NumEtudiant: new FormControl('')
     });
}




submit(){

  const formData = this.Form.getRawValue();  
  if(!formData.AdresseEtudiant ||
    !formData.DateNaissance ||
    !formData.EmailEtudiant ||
    !formData.NomEtudiant ||
    !formData.PrenomEtudiant ||
    !formData.TelEtudiant ){
      this._error="Il faut remplir tous les champs."
  }else{
   let Profile={
      AdresseEtudiant: formData.AdresseEtudiant,
      DateNaissance: formData.DateNaissance,
      NomEtudiant: formData.NomEtudiant,
      PrenomEtudiant: formData.PrenomEtudiant ,
      TelEtudiant:formData.TelEtudiant
    }
    this.profile.profile_update(JSON.parse(localStorage.getItem('NumEtu') || ''),Profile).subscribe(
      success=>{
        //@ts-ignore
        this._success=success.message
      },
      error=>{
        //@ts-ignore
        this._error=error.error.message

      }
    )
  }

}



  ngOnInit(): void {
    let pipe = new DatePipe('en-US');
    this.profile.profile_data(JSON.parse(localStorage.getItem('NumEtu') || '')).subscribe(
      data=>{

        this._data=data
        console.log(this._data);
        //@ts-ignore
        this._data.DateNaissance=pipe.transform(data.DateNaissance, "yyyy-MM-dd")
        if(this._data.Parcours)
          this._parcours=this._data.Parcours.NiveauParcours+' '+this._data.Parcours.Libelle;
        else
           this._parcours="Vous n'etes inscrit dans aucun parcours";
      },
      error=>{
        
      }
    );

  }

}
