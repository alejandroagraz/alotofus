Feature: Company types listing page
  In order to manage Alotofus
  As an admin
  I want to manage company types listings

  Background:
    Given the database is clean
    And the following company types exist:
      |name                   |
      |Individual Entrepreneur|
      |Non-profit Organization|
    And the following candidates exist:
      |name   |surname |email              |role      |password|validated|activated|
      |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
      |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
    And I am logged as "admin@alotofus.com" with password "baraka0"

  @javascript @ALOU-226
  Scenario: Listing company types
    Given I am on "admin listings companyTypes" page
    Then after waiting I should see 2 resources

  @javascript @ALOU-159
  Scenario: Creating new company types
    Given I am on "admin listings companyTypes" page
    And I wait until list loads
    When I click in new resource button
    And I fill in the following:
      |translations_en|New company type|
      |translations_es|Nuevo tipo de compañia|
      |translations_eu|Enpresa mota berria|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 3 resources

  @javascript @ALOU-159
  Scenario: Editing existing company types
    Given I am on "admin listings companyTypes" page
    And I wait until list loads
    When I click in edit resource button for "Non-profit Organization"
    And I fill in the following:
      |translations_es|Organización sin ánimo de lucro|
      |translations_eu|Irabazteko asmorik gabeko erakundea|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 2 resources

  @ALOU-159
  Scenario: Accessing as a normal user
    Given I am logged as "validated@gmail.com" with password "baraka0"
    And I am on "admin listings companyTypes" page with 403 error