Feature: CompanySectors listing page
  In order to manage Alotofus
  As an admin
  I want to manage companySectors listings

  Background:
    Given the database is clean
    And the following company sectors exist:
      |name                   |
      |Business administration|
      |Quality, I+D        |
    And the following candidates exist:
      |name   |surname |email              |role      |password|validated|activated|
      |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
      |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
    And I am logged as "admin@alotofus.com" with password "baraka0"

  @javascript @ALOU-226
  Scenario: Listing companySectors
    Given I am on "admin listings companySectors" page
    Then after waiting I should see 2 resources

  @javascript @ALOU-159
  Scenario: Creating new companySectors
    Given I am on "admin listings companySectors" page
    And I wait until list loads
    When I click in new resource button
    And I fill in the following:
      |translations_en|Sports  |
      |translations_es|Deportes|
      |translations_eu|Kirolak |
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 3 resources

  @javascript @ALOU-159
  Scenario: Editing existing companySectors
    Given I am on "admin listings companySectors" page
    And I wait until list loads
    When I click in edit resource button for "Business administration"
    And I fill in the following:
      |translations_es|Administración de empresas|
      |translations_eu|Enpresen kudaketa|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 2 resources

  @ALOU-159
  Scenario: Accessing as a normal user
    Given I am logged as "validated@gmail.com" with password "baraka0"
    And I am on "admin listings companySectors" page with 403 error