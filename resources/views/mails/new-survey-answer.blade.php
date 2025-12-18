<div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #2d3748; line-height: 1.6; max-width: 600px; margin: 20px auto; border: 1px solid #e2e8f0; border-top: 4px solid #4f46e5; padding: 30px; border-radius: 8px; background-color: #ffffff;">
    
    <h1 style="margin-top: 0; color: #1a202c; font-size: 22px; border-bottom: 1px solid #edf2f7; padding-bottom: 15px;">
        New Survey Answer Submitted
    </h1>

    <p style="font-size: 13px; color: #718096; margin-bottom: 25px;">
        <strong>Date:</strong> {{ now()->format('F j, Y, g:i a') }}
    </p>

    <div style="background-color: #f7fafc; padding: 20px; border-radius: 6px; border-left: 4px solid #cbd5e0;">
        <p style="margin: 0;">
            A new response has been successfully submitted for your survey:
        </p>
        <p style="margin: 10px 0 0 0; font-size: 18px; font-weight: bold; color: #4f46e5;">
            "{{ $survey->title }}"
        </p>
    </div>

    <p style="margin-top: 25px;">
        Please log in to your administration panel to review the details and analytics associated with this submission.
    </p>

    <hr style="border: 0; border-top: 1px solid #edf2f7; margin: 30px 0;">

    <p style="font-size: 11px; color: #a0aec0; text-align: center;">
        This is an automated notification from your Survey Management System.
    </p>
</div>