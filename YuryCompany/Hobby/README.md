# YuryCompany_Hobby module

The following functionality have been implemented: 
- Add a custom customer attribute “Hobby“ with possible options: “Yoga“, “Traveling“, “Hiking“. The attribute is not required.
- Add a possibility to fetch / edit the attribute using GraphQL.
- Admin must be able to edit the attribute in admin panel.
- Add a link in the customer account menu.
- The link must lead on the page “Edit Hobby“. There must be a form with one field “Hobby“ and submit button.
- “Hobby“ must be displayed in the top right corner in the format “Hobby: %s“ and must be correspond to the current customer hobby. Place it right away after the welcome message. 
NB! Notice that it must work correctly with all enabled Magento caches

## Installation

The YuryCompany_Hobby module is a custom module. 
To install it please run the following commands:

* bin/magento setup:upgrade
* bin/magento setup:di:compile
* bin/magento setup:static-content:deploy -f

## Graphql

### Query 

```
{
  customer {
    group_id
    firstname
    lastname
    suffix
    email
    hobby
    addresses {
      firstname
      lastname
      street
      city
      region {
        region_code
        region
      }
      postcode
      country_code
      telephone
    }
  }
}
```

### Mutation

``` 
mutation{
  updateCustomer(
    input:{
      firstname: "Devtest"
      lastname: "Developer"
      hobby: 1
    }
  ){
    customer{
      firstname
      lastname
      hobby
    }
  }
}
```
