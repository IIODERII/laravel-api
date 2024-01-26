<div>
    <h1>Ciao {{ $lead->name }},</h1>
    <p>Grazie per averci contattato, ecco i dettagli:</p>
    <ul>
        <li><strong>Nome:</strong> {{ $lead->name }}</li>
        <li><strong>Email:</strong> {{ $lead->email }}</li>
        <li><strong>Indirizzo:</strong> {{ $lead->address }}</li>
        <li><strong>Messaggio:</strong> {{ $lead->message }}</li>
    </ul>
</div>
