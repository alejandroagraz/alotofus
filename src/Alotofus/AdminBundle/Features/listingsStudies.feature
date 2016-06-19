Feature: Studies listing page
  In order to manage Alotofus
  As an admin
  I want to manage studies listings

  Background:
    Given the database is clean
    And the following studies levels exist:
      |name                                |
      |Engineer's Degree - Engineer Diploma|
      |Graduate Certificate                |
      |Master's Degree                     |
    And the following studies areas exist:
      |name                   |
      |BsC in Computer Science|
      |MsC in Computer Science|
    And the following candidates exist:
      |name   |surname |email              |role      |password|validated|activated|
      |Nombre |Apellido|validated@gmail.com|ROLE_USER |baraka0 |true     |true     |
      |Admin  |Admin   |admin@alotofus.com |ROLE_ADMIN|baraka0 |true     |true     |
    And I am logged as "admin@alotofus.com" with password "baraka0"

  @javascript @ALOU-226
  Scenario: Listing studies
    Given I am on "admin listings studies" page
    Then after waiting I should see 2 resources

  @javascript @ALOU-159
  Scenario: Creating new studies
    Given I am on "admin listings studies" page
    And I wait until list loads
    When I click in new resource button
    And I fill in the following:
      |translations_en|BsC in economics|
      |translations_es|Licenciado en Economía|
      |translations_eu|Ekonomian Lizentziatua|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 3 resources

  @javascript @ALOU-159
  Scenario: Editing existing studies
    Given I am on "admin listings studies" page
    And I wait until list loads
    When I click in edit resource button for "MsC in Computer Science"
    And I fill in the following:
      |translations_es|Ingeniero en Informática|
      |translations_eu|Informatikan Ingeniaria|
    And I press "Send"
    Then "Changes have been saved successfully" should pop up
    And I should see 2 resources

  @ALOU-159
  Scenario: Accessing as a normal user
    Given I am logged as "validated@gmail.com" with password "baraka0"
    And I am on "admin listings studies" page with 403 error
