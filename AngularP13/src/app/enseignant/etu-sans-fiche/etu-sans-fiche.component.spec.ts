import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EtuSansFicheComponent } from './etu-sans-fiche.component';

describe('EtuSansFicheComponent', () => {
  let component: EtuSansFicheComponent;
  let fixture: ComponentFixture<EtuSansFicheComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EtuSansFicheComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(EtuSansFicheComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
