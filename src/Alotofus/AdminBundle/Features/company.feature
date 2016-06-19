Feature: Company page
    In order to manage Alotofus
    As an admin
    I want to activate and deactivate companies

    Background:
        Given the database is clean
        And the following companies exist:
            |name              |companyId|email               |password|createdAt|activated |
            |Boso Group S.L.   |B95677100|info@bosogroup.net  |baraka0 |1 day ago|true      |
            |Euskaltel S.A.    |A48766695|info@euskaltel.es   |baraka0 |2 day ago|false     |
            |Indra Sistemas S.A|A28599033|info@indra.com      |baraka0 |3 day ago|false     |
            |Ibermática S.A.   |A54552215|info@ibermatica.net |baraka0 |4 day ago|false     |
         And the following users exist:
            |name   |surname |email              |role      |password|validated|activated|
            |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
        And I am logged as "admin@alotofus.com" with password "baraka0"

    @javascript @ALOU-163
    Scenario: Listing companies
        Given I am on "company admin" page
        And I wait until list loads
        Then I should see 4 companies

    @javascript @ALOU-163
    Scenario: Filtering companies by name
        Given I am on "company admin" page
        And I wait until list loads
        When I fill in "Boso Group" for "name"
        Then after waiting, I should see 1 companies

    @javascript @ALOU-163
    Scenario: Filtering companies by email
        Given I am on "company admin" page
        And I wait until list loads
        When I fill in "euskaltel" for "email"
        Then after waiting, I should see 1 companies

    @javascript @ALOU-163 
    Scenario: Filtering companies by activated
        Given I am on "company admin" page
        And I wait until list loads
        When I select "No" from "activated"
        Then after waiting, I should see 3 companies

    @javascript @ALOU-163
    Scenario: Activating companies inline
        Given I am on "company admin" page
        And I wait until list loads
        When I press "accept-company" for "Euskaltel S.A."
        Then after waiting, "Euskaltel S.A." must be "activated"

    @javascript @ALOU-163
    Scenario: Deactivating companies inline
        Given I am on "company admin" page
        And I wait until list loads
        When I press "deactivate-company" for "Boso Group S.L."
        Then after waiting, "Boso Group S.L." must be "deactivated"

    @javascript @ALOU-163
    Scenario: Deleting companies
        Given I am on "company admin" page
        And I wait until list loads
        When I press "delete-company" for "Euskaltel S.A."
        And I confirm the popup
        Then after waiting, "Euskatel S.A." must be "hidden"

        