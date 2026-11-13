<?php
require_once '../inc/config.php';
require_once '../inc/database.php';
require_once '../inc/functions.php';

$id = (int) ($_GET['id'] ?? 0);

$ticket = getTicketById($id);

if (!$ticket) {
    die('Ticket nicht gefunden.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    updateTicket(
        $id,
        trim($_POST['title']),
        trim($_POST['description']),
        $_POST['priority'],
        $_POST['status']
    );

    header('Location: index.php');

    exit;
}

require_once '../inc/header.php';
?>
<main class="dashboard">
    <section class="ticket-form">

        <h2>
            Ticket bearbeiten
        </h2>

        <form method="post">

            <label>

                Titel

                <input
                    type="text"
                    name="title"
                    value="<?= htmlspecialchars($ticket['title']); ?>"
                    require
                >

            </label>

            <label>

                Beschreibung

                <textarea
                    name="description"
                    require
                ><?= htmlspecialchars($ticket['description']); ?></textarea>

            </label>

            <label>

                Priorität

                <select name="priority">

                    <option
                        <?= $ticket['priority'] === 'Niedrig' ? 'selected' : ''; ?>
                    >
                        Niedrig
                    </option>

                    <option
                        <?= $ticket['priority'] === 'Mittel' ? 'selected' : ''; ?>
                    >
                        Mittel
                    </option>

                    <option
                        <?= $ticket['priority'] === 'Hoch' ? 'selected' : ''; ?>
                    >
                        Hoch
                    </option>

                    <option
                        <?= $ticket['priority'] === 'Kritisch' ? 'selected' : ''; ?>
                    >
                        Kritisch
                    </option>

                </select>
            </label>

            <label>

                Status
                
                <select name="status">

                    <option
                        <?= $ticket['status'] === 'Neu' ? 'selected' : ''; ?>
                    >
                        Neu
                    </option>

                    <option
                        <?= $ticket['status'] === 'In Bearbeitung' ? 'selected' : ''; ?>
                    >
                        In Bearbeitung
                    </option>

                    <option
                        <?= $ticket['status'] === 'Geschlossen' ? 'selected' : ''; ?>
                    >
                        Geschlossen
                    </option>

                </select>
            </label>

            <button type="submit">
                Änderung speichern
            </button>

        </form>

    </section>
</main>

<?php require_once '../inc/footer.php'; ?>