// Automaticaly generate a random token of 64 characters and copy it to the clipboard.

const { exec } = require('child_process');
const token = require('crypto').randomBytes(64).toString('hex');

// Windows
exec(`echo ${token} | clip`, (err) => {
  if (err)
  {
    console.error('Failed to copy to clipboard:', err);
  }
  else
  {
    console.log('Token generated and copied to clipboard.\n', token);
  }
});

// macOS
/*
exec(`echo ${token} | pbcopy`, (err) => {
   if (err)
   {
     console.error('Failed to copy to clipboard:', err);
   }
   else
   {
     console.log('Token generated and copied to clipboard.\n', token);
   }
});
*/