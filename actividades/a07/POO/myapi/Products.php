<?php

namespace MyApi\Backend;

use MyApi\Backend\DataBase;

class Products extends DataBase
{
    private array $response = []; // Using 'response' as an array to store query results as per PDF description

    public function __construct(string $db, string $user = '', string $pass = '')
    {
        parent::__construct($db, $user, $pass);
        // Initialize response or any other specific Products class attributes here
    }

    public function add(object $data): void
    {
        // Placeholder for add logic
        $this->response = ['status' => 'success', 'message' => 'Product added', 'data' => $data];
    }

    public function delete(string $id): void
    {
        // Placeholder for delete logic
        $this->response = ['status' => 'success', 'message' => "Product with ID {$id} deleted"];
    }

    public function edit(object $data): void
    {
        // Placeholder for edit logic
        $this->response = ['status' => 'success', 'message' => 'Product updated', 'data' => $data];
    }

    public function list(): void
    {
        // Placeholder for list logic
        $this->response = ['status' => 'success', 'data' => [['id' => 1, 'name' => 'Product A'], ['id' => 2, 'name' => 'Product B']]];
    }

    public function search(string $query): void
    {
        // Placeholder for search logic
        $this->response = ['status' => 'success', 'data' => [['id' => 1, 'name' => 'Product A', 'match' => $query]]];
    }

    public function single(string $id): void
    {
        // Placeholder for single product by ID logic
        $this->response = ['status' => 'success', 'data' => ['id' => $id, 'name' => 'Single Product ' . $id]];
    }

    public function singleByName(string $name): void
    {
        // Placeholder for single product by name logic
        $this->response = ['status' => 'success', 'data' => ['id' => 3, 'name' => $name]];
    }

    public function getData(): string
    {
        return json_encode($this->response);
    }
}
