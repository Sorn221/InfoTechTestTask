<?php

class m250121_000003_insert_test_data extends CDbMigration
{
    public function up()
    {
        // Тестовые пользователи
        $users = [
            [
                'username' => 'admin',
                'password' => CPasswordHelper::hashPassword('admin123'),
                'email' => 'admin@example.com',
                'phone' => '+79991234567',
            ],
            [
                'username' => 'user1',
                'password' => CPasswordHelper::hashPassword('user123'),
                'email' => 'user1@example.com',
                'phone' => '+79997654321',
            ],
        ];
        
        foreach ($users as $user) {
            $this->insert('user', $user);
        }
        
        // Тестовые авторы
        $authors = [
            ['name' => 'Лев Толстой'],
            ['name' => 'Фёдор Достоевский'],
            ['name' => 'Антон Чехов'],
            ['name' => 'Александр Пушкин'],
            ['name' => 'Михаил Лермонтов'],
            ['name' => 'Николай Гоголь'],
            ['name' => 'Иван Тургенев'],
            ['name' => 'Александр Солженицын'],
            ['name' => 'Борис Пастернак'],
            ['name' => 'Михаил Булгаков'],
        ];
        
        foreach ($authors as $author) {
            $this->insert('author', $author);
        }
        
        // Тестовые книги
        $books = [
            [
                'title' => 'Война и мир',
                'year' => 1869,
                'isbn' => '9785171200852',
                'description' => 'Роман-эпопея Льва Толстого',
            ],
            [
                'title' => 'Анна Каренина',
                'year' => 1877,
                'isbn' => '9785171200869',
                'description' => 'Роман Льва Толстого',
            ],
            [
                'title' => 'Преступление и наказание',
                'year' => 1866,
                'isbn' => '9785171200876',
                'description' => 'Роман Фёдора Достоевского',
            ],
        ];
        
        foreach ($books as $index => $book) {
            $this->insert('book', $book);
            
            // Связываем книги с авторами
            $this->insert('book_author', [
                'book_id' => $index + 1,
                'author_id' => $index + 1,
            ]);
        }
        
        // Роли и разрешения
        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => 2,
            'description' => 'Administrator role',
        ]);
        
        $this->insert('auth_item', [
            'name' => 'user',
            'type' => 2,
            'description' => 'Authenticated user',
        ]);
        
        $this->insert('auth_item', [
            'name' => 'guest',
            'type' => 2,
            'description' => 'Guest (unauthenticated)',
        ]);
        
        // Назначаем роли пользователям
        $this->insert('auth_assignment', [
            'itemname' => 'admin',
            'userid' => '1', // admin
        ]);
        
        $this->insert('auth_assignment', [
            'itemname' => 'user',
            'userid' => '2', // user1
        ]);
    }
    
    public function down()
    {
        // Откат данных (в обратном порядке)
        $this->delete('auth_assignment');
        $this->delete('auth_item');
        $this->delete('book_author');
        $this->delete('book');
        $this->delete('author');
        $this->delete('user');
    }
}