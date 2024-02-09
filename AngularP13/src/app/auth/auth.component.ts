import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder } from '@angular/forms';

import {AuthService} from '../auth.service';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.css']
})
export class AuthComponent implements OnInit {
  //@ts-ignore
  form: FormGroup;


  constructor(private fb:FormBuilder, private Auth:AuthService, private router:Router) { }

  ngOnInit(): void {
    this.form=this.fb.group({
      email:'',
      password:''
    });

  }
 
  error:string="";
  success:string="";

  submit(){

      const formData = this.form.getRawValue();
      const data={
        email: formData.email,
        password: formData.password
      }
      this.Auth.getUser(data).subscribe(
        result => {
            console.log('success');
            //@ts-ignore
            console.log(result);
            if(result.success){
            //@ts-ignore
            if(result.roles=='Etudiant'){this.Auth.setIsEtudiantLogedIn(true,result.result.NumEtudiant.toString()); this.router.navigate(['Etu'])}
            //@ts-ignore
            else {if(result.roles=='Administratif'){this.Auth.setIsAdministratifLogedIn(true,result.result.id.toString()); this.router.navigate(['Adm'])}
            //@ts-ignore
            else if(result.roles=='Enseignant'){this.Auth.setIsEnseignantLogedIn(true); this.router.navigate(['Ens'])}}}
            else{
              localStorage.removeItem('EtudiantLogged');
              localStorage.removeItem('EnseignantLogged');
              localStorage.removeItem('AdministratifLogged');
            }
           
        },
        error=> {
          console.log('error');
          console.log(error);
          this.error=error.error.message;
      }
      );
      /*
      {
        "email":"test@test.com",
        "password":"somepassword"
      }
      
      
      */
   
  }

}
