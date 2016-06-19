Feature: CompanySizes listing page
  In order to manage Alotofus
  As an admin
  I want to manage companySizes listings

  Background:
    Given the database is clean
    And the following company sizes exist:
      |name            |
      |Micro enterprise|
      |Start Up        |
    And the following candidates exist:
      |name   |surname |email              |role      |password|validated|activated|
      |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
      |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
    And I am logged as "admin@alotofus.com" with password "baraka0"

  @javascript @ALOU-226
  Scenario: Listing companySizes
    Given I am on "admin listings companySizes" page
    Then after waiting I should see 2 resources

  @javascript @ALOU-159
  Scenario: Creating new companySizes
    Given I am on "admin listings companySizes" page
    And I wait until list loads
    When I click in new resource button
    And I fill in the following:
      |translations_en|NGO|
      |translations_es|ONG|
      |translations_eu|GKE|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 3 resources

  @javascript @ALOU-159
  Scenario: Editing existing companySizes
    Given I am on "admin listings companySizes" page
    And I wait until list loads
    When I click in edit resource button for "Micro enterprise"
    And I fill in the following:
      |translations_es|Microempresa|
      |translations_eu|Mikroenpresa|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 2 resources

  @ALOU-159
  Scenario: Accessing as a normal user
    Given I am logged as "validated@gmail.com" with password "baraka0"
    And I am on "admin listings companySizes" page with 403 error