<?php

test('Crear libro', function () {
    $book = new Book([
        'title' => 'Ejemplo de Libro',
    ]);
    $this->assertEquals('Ejemplo de Libro', $book->getTitle());
});
