<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice - Monthly Services</title>
    <style>
      body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        color: #222;
        margin: 40px;
        background: #f9f9f9;
      }
      .container {
        background: #fff;
        padding: 40px;
        border: 1px solid #ccc;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        max-width: 900px;
        margin: auto;
      }
      .header {
        text-align: center;
        border-bottom: 4px solid #000;
        margin-bottom: 30px;
        padding-bottom: 10px;
      }
      .header h1 {
        font-size: 32px;
        margin: 0;
      }
      .header p {
        font-size: 15px;
        margin: 2px 0;
      }
      .details {
        display: flex;
        justify-content: space-between;
        margin-bottom: 40px;
      }
      .details div h3 {
        font-size: 14px;
        text-transform: uppercase;
        border-bottom: 1px solid #000;
        margin-bottom: 8px;
        padding-bottom: 3px;
      }
      .details div p {
        margin: 0;
        font-size: 14px;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
      }
      table th,
      table td {
        padding: 12px;
        font-size: 14px;
      }
      table thead th {
        background: #000;
        color: #fff;
        text-align: left;
      }
      table tbody td {
        border-bottom: 1px solid #ddd;
      }
      table tfoot td {
        font-weight: bold;
        border-top: 2px solid #000;
      }
      .totals td {
        padding-top: 10px;
      }
      .totals .label {
        text-align: right;
      }
      .note,
      .banking {
        font-size: 14px;
        margin-top: 20px;
        line-height: 1.6;
      }
      .support-details {
        font-size: 14px;
        margin-top: 20px;
      }
      .support-details ul {
        padding-left: 20px;
      }
      .support-details li {
        margin-bottom: 6px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>Invoice</h1>
        <p>Invoice #: {{ $invoice->invoice_number }}</p>
        <p>
          Date: {{ $invoice->date_start }} <span style="color: red"> To</span> {{ $invoice->date_end }}
        </p>
        <p>Due Date: {{ $invoice->due_date }}</p>
      </div>

      <div class="details">
        <div>
          <h3>Bill To</h3>
          <p>{{ $invoice->client->name }}<br />{{ $invoice->client->business_name }}</p>
        </div>
        <div>
          <h3>Prepared By</h3>
          <p>Kagiso Ramogayana<br />Freelance Web Designer & Developer</p>
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price (USD)</th>
            <th>Total (USD)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoice->items as $item)
          <tr>
            <td>{{ $item->description }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->unit_price, 2) }}</td>
            <td>{{ number_format($item->line_total, 2) }}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="totals">
            <td colspan="3" class="label">Total Due</td>
            <td>${{ number_format($invoice->total_amount, 2) }}</td>
          </tr>
        </tfoot>
      </table>

      <div class="banking">
        <strong>Pay via PayPal:</strong><br />
        PayPal Email: kagiso.ramogayana@gmail.com<br />
        Reference: {{ $invoice->invoice_number }}
      </div>

      <p class="note">
        This invoice reflects the monthly hosting and maintenance for your
        website.
      </p>
    </div>
  </body>
</html>
