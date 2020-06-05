# CRUD application codeigniter

## Download codeigniter version 3.0
After extracting downloaded file in your htdocs folder
1. run xampp
2. check to see the welcome page of the application 

## Create Database

go to http://localhost/phpmyadmin

```sql
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

```

## Create Routes


```php
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['crud'] = 'crud/index'; //home page for the application
$route['crud/(:num)'] = 'crud/show/$1'; // single inserted item
$route['crudCreate']['post'] = 'crud/store'; // for creating an item post
$route['crudEdit/(:any)'] = 'crud/edit/$1'; // for editing the item
$route['crudUpdate/(:any)']['put'] = 'crud/update/$1'; // Updating the item
$route['crudDelete/(:any)']['delete'] = 'crud/delete/$1'; // deleting the item
```

## Views for the crud operations

Create theme folder in views folder with the following files

1. header.php
```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="container">
```

2. footer.php

```html
</div>
</body>
</html>
```

3. list.php

```html
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left">
      <h2>CRUD application</h2>
    </div>
    <div class="pull-right">
      <a class="btn btn-success" href="<?php echo base_url('itemCRUD/create') ?>"> Create New Item</a>
    </div>
  </div>
</div>


<table class="table table-bordered">


  <thead>
    <tr>
      <th>Title</th>
      <th>Description</th>
      <th width="220px">Action</th>
    </tr>
  </thead>


  <tbody>
    <?php foreach ($data as $item) { ?>
      <tr>
        <td><?php echo $item->title; ?></td>
        <td><?php echo $item->description; ?></td>
        <td>
          <form method="DELETE" action="<?php echo base_url('itemCRUD/delete/' . $item->id); ?>">
            <a class="btn btn-info" href="<?php echo base_url('itemCRUD/' . $item->id) ?>"> show</a>
            <a class="btn btn-primary" href="<?php echo base_url('itemCRUD/edit/' . $item->id) ?>"> Edit</a>
            <button type="submit" class="btn btn-danger"> Delete</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>


</table>
```

4. 

## Make model 

In the models folder create the model file

```php

<?php

class CrudModel extends CI_Model
{

  public function get_itemCRUD()
  {
    if (!empty($this->input->get("search"))) {
      $this->db->like('title', $this->input->get("search"));
      $this->db->or_like('description', $this->input->get("search"));
    }
    $query = $this->db->get("items");
    return $query->result();
  }


  public function insert_item()
  {
    $data = array(
      'title' => $this->input->post('title'),
      'description' => $this->input->post('description')
    );
    return $this->db->insert('items', $data);
  }


  public function update_item($id)
  {
    $data = array(
      'title' => $this->input->post('title'),
      'description' => $this->input->post('description')
    );
    if ($id == 0) {
      return $this->db->insert('items', $data);
    } else {
      $this->db->where('id', $id);
      return $this->db->update('items', $data);
    }
  }


  public function find_item($id)
  {
    return $this->db->get_where('items', array('id' => $id))->row();
  }


  public function delete_item($id)
  {
    return $this->db->delete('items', array('id' => $id));
  }
}


```

## Add Controller for crud operations


