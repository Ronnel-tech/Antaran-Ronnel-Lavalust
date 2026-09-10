<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('ProductModel');
    }

    public function index()
    {
        $this->call->view('product/ProductView', [
            'products' => $this->ProductModel->all(),
            'user_email' => $this->session->userdata('user_email'),
            'user_role' => $this->session->userdata('user_role'),
            'notification' => $this->session->flashdata('notification')
        ]);
    }

    public function create()
    {
        $this->require_admin();
        $this->render_form('product/create', [], $this->empty_product());
    }

    public function store()
    {
        $this->require_admin();
        [$product, $errors] = $this->product_input();

        if ($errors) {
            $this->render_form('product/create', $errors, $product);
            return;
        }

        $this->ProductModel->create($product);
        $this->session->set_flashdata('notification', 'Product added successfully.');
        $this->redirect('/products');
    }

    public function edit($id)
    {
        $this->require_admin();
        $product = $this->ProductModel->find((int) $id);

        if (!$product) {
            show_404();
            return;
        }

        $this->render_form('product/edit', [], $product);
    }

    public function update($id)
    {
        $this->require_admin();
        $id = (int) $id;

        if (!$this->ProductModel->find($id)) {
            show_404();
            return;
        }

        [$product, $errors] = $this->product_input();
        if ($errors) {
            $product['id'] = $id;
            $this->render_form('product/edit', $errors, $product);
            return;
        }

        $this->ProductModel->update($id, $product);
        $this->session->set_flashdata('notification', 'Product updated successfully.');
        $this->redirect('/products');
    }

    public function delete($id)
    {
        $this->require_admin();
        $this->ProductModel->delete((int) $id);
        $this->session->set_flashdata('notification', 'Product deleted successfully.');
        $this->redirect('/products');
    }

    private function product_input(): array
    {
        $product = [
            'product_name' => trim((string) $this->io->post('product_name')),
            'description' => trim((string) $this->io->post('description')),
            'price' => trim((string) $this->io->post('price')),
            'quantity' => trim((string) $this->io->post('quantity'))
        ];
        $errors = [];

        if ($product['product_name'] === '' || strlen($product['product_name']) > 100) {
            $errors[] = 'Product name is required and must be 100 characters or fewer.';
        }
        if ($product['description'] === '') {
            $errors[] = 'Description is required.';
        }
        if (!is_numeric($product['price']) || (float) $product['price'] < 0) {
            $errors[] = 'Price must be a non-negative number.';
        }
        if (filter_var($product['quantity'], FILTER_VALIDATE_INT) === false || (int) $product['quantity'] < 0) {
            $errors[] = 'Quantity must be a non-negative whole number.';
        }

        if (!$errors) {
            $product['price'] = number_format((float) $product['price'], 2, '.', '');
            $product['quantity'] = (int) $product['quantity'];
        }

        return [$product, $errors];
    }

    private function empty_product(): array
    {
        return ['product_name' => '', 'description' => '', 'price' => '', 'quantity' => ''];
    }

    private function render_form(string $view, array $errors, array $product): void
    {
        $this->call->view($view, ['errors' => $errors, 'product' => $product]);
    }

    private function require_admin(): void
    {
        if ($this->session->userdata('user_role') !== 'admin') {
            show_error('403 Forbidden', 'Administrator access is required for this action.', 'error_general', 403);
            exit;
        }
    }

    private function redirect(string $path): void
    {
        header('Location: ' . site_url($path));
        exit;
    }
}
