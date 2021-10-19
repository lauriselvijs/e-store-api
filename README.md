# E-STORE
CRUD operations API with products and categories, using PHP

## Category
**GET** */e-store/api/categories/read.php*
> Output information about category name, id and created at date.

**GET** */e-store/api/categories/read_single.php?id=*
> Output information about category name, id and created at date of single record.

**POST** */e-store/api/categories/create.php*
> Add new category to the database.

**Input**
  * Name name:string
  
**POST** */e-store/api/categories/update.php*
> Update category.

**Input**
  * Category ID id:int
  * Name name:string
  
**POST** */e-store/api/categories/delete.php*
> Delete category.

**Input**
  * Category ID id:int
  
 ## Product
**GET** */e-store/api/products/read.php*
> Output information about product id, name, price, quantity, category id,
> category name, created at.

**GET** */e-store/api/products/read_single.php?id=*
> Output information about one product id, name, price, quantity, category id,
> category name, created at.

**POST** */e-store/api/products/create.php*
> Add new product to the database.

**Input**
  * Name name:string
  * Price price:decimal(19,4)
  * Quantity quantity:int
  * Category ID category_id:int
  
**POST** */e-store/api/products/update.php*
> Update product.

**Input**
  * Product ID id:int
  * Name name:string
  * Price price:decimal(19,4)
  * Quantity quantity:int
  * Category ID category_id:int
  
**POST** */e-store/api/products/delete.php*
> Delete product.

**Input**
  * Product ID id:int
    
    
