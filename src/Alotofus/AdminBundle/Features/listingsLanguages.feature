Feature: Languages listing page
  In order to manage Alotofus
  As an admin
  I want to manage languages listings

  Background:
    Given the database is clean
    And the following languages exist:
      |name   |
      |English|
      |French |
    And the following candidates exist:
      |name   |surname |email              |role      |password|validated|activated|
      |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
      |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
    And I am logged as "admin@alotofus.com" with password "baraka0"

  @javascript @ALOU-226
  Scenario: Listing languages
    Given I am on "admin listings languages" page
    Then after waiting I should see 2 resources

  @javascript @ALOU-159
  Scenario: Creating new languages
    Given I am on "admin listings languages" page
    And I wait until list loads
    When I click in new resource button
    And I fill in the following:
      |translations_en|Spanish|
      |translations_es|Castellano|
      |translations_eu|Gaztelania|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 3 resources

  @javascript @ALOU-159
  Scenario: Editing existing languages
    Given I am on "admin listings languages" page
    And I wait until list loads
    When I click in edit resource button for "English"
    And I fill in the following:
      |translations_es|Ingles  |
      |translations_eu|Ingelesa|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 2 resources

  @ALOU-159
  Scenario: Accessing as a normal user
    Given I am logged as "validated@gmail.com" with password "baraka0"
    And I am on "admin listings languages" page with 403 error
