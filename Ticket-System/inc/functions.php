<?php
declare(strict_types=1);

function createTicket(
    string $title,
    string $description,
    string $priority
): bool {

    $pdo = getPDO();

    $sql = "
        INSERT INTO tickets
        (
            title,
            description,
            priority
        )
        VALUES
        (
            :title,
            :description,
            :priority
        )
    ";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        'title' => $title,
        'description' => $description,
        'priority' => $priority
    ]);
}

function getTickets(): array
{
    $pdo = getPDO();

    $sql = "
        SELECT
            id,
            title,
            description,
            priority,
            status,
            created_at
        FROM tickets
        ORDER BY id DESC
    ";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll();
}

function getTicketById(int $id): array|false
{
    $pdo = getPDO();

    $sql = "
        SELECT
            id,
            title,
            description,
            priority,
            status
        FROM tickets
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'id' => $id
    ]);

    return $stmt->fetch();
}

function updateTicket(
    int $id,
    string $title,
    string $description,
    string $priority,
    string $status
): bool {

    $pdo = getPDO();

    $sql = "
        UPDATE tickets
        SET
            title = :title,
            description = :description,
            priority = :priority,
            status = :status
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'priority' => $priority,
        'status' => $status
    ]);
}
?>