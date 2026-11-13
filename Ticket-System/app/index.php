<?php
require_once '../inc/config.php';
require_once '../inc/database.php';
require_once '../inc/functions.php';
require_once '../inc/header.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $priority = trim($_POST['priority'] ?? '');

    if (
        $title !== '' && $description !== ''
    ) {
        createTicket(
            $title,
            $description,
            $priority
        );

        $message = 'Ticket erfolgreich erstellt.';
    }
}

$tickets = getTickets();
?>
    <main class="dashboard">
        <section class="ticket-form">

            <h2>
                Neues Ticket
            </h2>

            <?php if ($message !== '') : ?>
            
            <p class="success-message">
                <?= htmlspecialchars($message); ?>
            </p>

            <?php endif; ?>

            <form method="post">
                <label>
                    
                    Titel

                    <input
                        type="text"
                        name="title"
                        required
                    >
                </label>

                <label>
                    
                    Beschreibung

                    <textarea
                        name="description"
                        required
                    ></textarea>
                </label>

                <label>
                    
                    Priorität

                    <select name="priority">

                        <option>
                            Niedrig
                        </option>

                        <option selected>
                            Mittel
                        </option>

                        <option>
                            Hoch
                        </option>

                        <option>
                            Kritisch
                        </option>

                    </select>
                </label>

                <button type="submit">
                    Ticket speichern
                </button>

            </form>

        </section>

        <section class="ticket-list">

            <h2>
                Tickets
            </h2>

            <?php if (empty($tickets)) : ?>

            <p>
                Keine Tickets vorhanden
            </p>

            <?php else : ?>
            
                <?php foreach ($tickets as $ticket) : ?>
                
                    <article class="ticket-card">

                        <h3>
                            <?= htmlspecialchars($ticket['title']) ?>
                        </h3>

                        <p>
                            <?= nl2br(
                                htmlspecialchars(
                                    $ticket['description']
                                )
                            ); ?>
                        </p>

                        <div class="ticket-meta">

                            <span class="
                                priority
                                priority-<?= strtolower(
                                    str_replace(
                                        ' ',
                                        '-',
                                        $ticket['priority']
                                    )
                                ); ?>
                            ">
                                <?= htmlspecialchars($ticket['priority']); ?>
                            </span>

                            <span class="
                                status
                                status-<?= strtolower(
                                    str_replace(
                                        ' ',
                                        '-',
                                        $ticket['status']
                                    )
                                ); ?>
                            ">
                                <?= htmlspecialchars($ticket['status']); ?>
                            </span>

                        </div>

                        <a
                            href="edit.php?id=<?= $ticket['id']; ?>"
                            class="btn-edit"
                        >
                            Bearbeiten
                        </a>

                    </article>
                
                <?php endforeach; ?>

            <?php endif; ?>

        </section>
    </main>

<?php require_once '../inc/footer.php'; ?>