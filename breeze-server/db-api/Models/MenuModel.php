<?php

namespace API\Database\Models;

use API\Database\Utils\Functions;

class MenuModel extends \API\Database\Classes\DbManager
{
    private $menuTable;
    private $menuItemTable;
    private $menuLocationTable;

    public function __construct(){

        parent::__construct();

        $this->menuTable = Functions::getTableNameFromModel($this);

        $this->menuItemTable = Functions::resolveTableName('menu_item');
        $this->menuLocationTable = Functions::resolveTableName('menu_location');

        $this->userTable = Functions::resolveTableName('user');

    }

    public function getMenus()
    {
        return $this->database->query("
            SELECT $this->menuTable.*, $this->userTable.name AS insert_by_name
            FROM $this->menuTable
            LEFT JOIN $this->userTable ON $this->menuTable.insert_by = $this->userTable.id
        ");
    }

    public function getMenuItems()
    {
        return $this->getItems($this->menuItemTable);
    }

    public function getMenuLocations()
    {
        return $this->getItems($this->menuLocationTable);
    }

    public function getMenuById($id)
    {
        return $this->getItemById($id, $this->menuTable);
    }

    public function getMenuItemsByParent($parent)
    {
        return $this->getItemsByParent($parent, $this->menuItemTable);
    }

    public function insertNewMenu($newMenu)
    {
        return $this->insertItem($newMenu, $this->menuTable);
    }

    public function insertNewMenuItem($newMenuItem)
    {
        return $this->insertItem($newMenuItem, $this->menuItemTable);
    }

    public function insertNewMenuLocation($location, $menu, $insert_by)
    {
        return $this->insertItem(array(
            'menu' => $menu,
            'location' => $location,
            'insert_by' => $insert_by
        ), $this->menuLocationTable);
    }

    public function updateMenuData($column, $newValue, $id)
    {
        return $this->updateItemData($column, $newValue, $id, $this->menuTable);
    }

    public function updateMenuItemData($column, $newValue, $id)
    {
        return $this->updateItemData($column, $newValue, $id, $this->menuItemTable);
    }

    public function deleteMenu($id)
    {
        return $this->deleteItem($id, $this->menuTable);
    }

    public function deleteMenuItem($id)
    {
        return $this->deleteItem($id, $this->menuItemTable);
    }

    public function deleteMenuItemByMenu($menu)
    {
        $req = $this->database->prepare("DELETE FROM $this->menuItemTable WHERE menu = ?");
        $res = $req->execute(array($menu));

        return $res;
    }

    public function deleteMenuLocations()
    {
        $res = $this->database->query("DELETE FROM $this->menuLocationTable");

        return $res;
    }
}
