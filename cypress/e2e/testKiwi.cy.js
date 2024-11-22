describe('template spec', () => {
  beforeEach(() => {
    cy.visit('http://localhost:80/kiwi_v3/public/login')
  })
  it('T1 : Log in', () => {
    cy.get('#inputEmail').type("Admin@quantior.com"),
    cy.get('#inputPassword').type("Admin_Qe"),
    cy.get('.btn-lg').click(), 
    cy.url().should('include', 'http://localhost/kiwi_v3/public/main/')
    cy.get(".btn").should("have.class", "btn-success")
  })  
})
