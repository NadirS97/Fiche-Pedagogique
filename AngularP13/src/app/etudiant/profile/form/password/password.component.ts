import { Component, OnInit } from '@angular/core';
import { AbstractControl, FormBuilder, FormControl, FormGroup, FormGroupDirective, ValidationErrors, ValidatorFn, Validators } from '@angular/forms';
import { PasswordService } from './password.service';

@Component({
  selector: 'app-password',
  templateUrl: './password.component.html',
  styleUrls: ['./password.component.css']
})
export class PasswordComponent implements OnInit {

  Form: FormGroup;
  _error:string=""
  _success:string=""

  ConfirmedValidator(controlName: string, matchingControlName: string){
    return (formGroup: FormGroup) => {
        const control = formGroup.controls[controlName];
        const matchingControl = formGroup.controls[matchingControlName];
        if (matchingControl.errors && !matchingControl.errors.confirmedValidator) {
            return;
        }
        if (control.value !== matchingControl.value) {
            matchingControl.setErrors({ confirmedValidator: true });
        } else {
            matchingControl.setErrors(null);
        }
    }
  }

  constructor(private password:PasswordService,private fb:FormBuilder) {

    this.Form= fb.group(
      {
        ancien: [null, Validators.compose([
           Validators.required])
        ],
        nouveau: [ null, Validators.compose([
           // 1. Password Field is Required
           Validators.required,
           // 6. Has a minimum length of 8 characters
           Validators.minLength(8)])
        ],
        confirmation: [null, Validators.compose([Validators.required])]
     }, { 
      validator: this.ConfirmedValidator('nouveau', 'confirmation')
    });

   }
   

   submit(){
    const formData = this.Form.getRawValue();
    
    if(formData.nouveau !== formData.confirmation)
      this._error="La confirmation du mot de passe doit etre la meme que le mot de passe saisi"
    else
      {
        const data={
          NumEtudiant:JSON.parse(localStorage.getItem('NumEtu') || ''),
          UserAcc:{
            Password:formData.ancien
          },
          NVPassword:formData.nouveau
        }
        this.password.Modifier(data).subscribe(
          data=>{
              //@ts-ignore
              this._success=data.message
              this._error=""
          },
          error=>{
            //@ts-ignore
            this._error=error.error.message
            this._success=""
          }      
          );
        
      }
   }
  
  ngOnInit(): void {
  }

}
