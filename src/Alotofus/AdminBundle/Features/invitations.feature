Feature: Invitations page
    In order to manage Alotofus
    As an admin
    I want to send invitations to registered user

    Background:
        Given the database is clean
        And the following candidates exist:
            |name   |surname |email              |role      |password|validated|activated|
            |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
            |Nombre2|Apellido|novalid@gmail.com  |ROLE_USER |baraka0 |false    |false    |
            |Nombre3|Apellido|novalid1@gmail.com |ROLE_USER |baraka0 |false    |false    |
            |Nombre4|Apellido|novalid2@gmail.com |ROLE_USER |baraka0 |false    |false    |
            |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
        And I am logged as "admin@alotofus.com" with password "baraka0"

    @javascript @ALOU-159 
    Scenario: Listing not validated candidates
        Given I am on "user invitations admin" page
        And I wait until list loads
        Then I should see 3 candidates

    @javascript @ALOU-159 
    Scenario: Submitting invitation with inline button
        Given I am on "user invitations admin" page
        And I wait until list loads
        When I click in send invitation for candidate "Nombre2"
        Then after waiting I should see 2 candidates

    @javascript @ALOU-159 
    Scenario: Submitting invitation with header button
        Given I am on "user invitations admin" page
        And I wait until list loads
        When I select all candidates 
        And I click in general send invitation button
        Then after waiting I should see 0 candidates

    @ALOU-159
    Scenario: Accessing as a normal user
        Given I am logged as "validated@gmail.com" with password "baraka0"
        And I am on "user invitations admin" page with 403 error



