import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FicheRecuesComponent } from './fiche-recues.component';

describe('FicheRecuesComponent', () => {
  let component: FicheRecuesComponent;
  let fixture: ComponentFixture<FicheRecuesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FicheRecuesComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FicheRecuesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
