<div
    style="font-family: Arial, sans-serif; background: #f7fafc; padding: 32px; border-radius: 12px; max-width: 480px; margin: auto; border: 1px solid #e2e8f0;">
    <div style="text-align: center; margin-bottom: 24px;">
        <img src="cid:banner_image" alt="finance-together-logo"
            style="width: 100px; height: auto; margin-bottom: 16px;">
        <h2 style="color: #2d3748; margin: 0 0 8px;">You've Been Invited!</h2>
    </div>
    <p style="color: #4a5568; font-size: 16px; margin-bottom: 16px;">
        Hey, you just got invited to join a group for the app <strong>{{ config('app.name') }}</strong> from
        <strong>{{$email}}</strong>!
    </p>
    <p style="color: #4a5568; font-size: 15px; margin-bottom: 24px;">
        Click the button below to accept your invitation and join the group.
    </p>
    <div style="text-align: center; margin-bottom: 24px;">
        <a href="{{ $url }}" target="_blank"
            style="background: #2563eb; color: #fff; font-weight: bold; padding: 12px 32px; border-radius: 6px; text-decoration: none; display: inline-block; font-size: 16px;">
            Join Group
        </a>
    </div>
    <p style="color: #a0aec0; font-size: 13px; text-align: center;">
        If you did not expect this invitation, you can safely ignore this email.
    </p>
</div>