# GitHub Push Steps

Git is initialized locally and the project can be pushed after a GitHub repository is created.

Suggested repository name:

```bash
peerconnect
```

Commands to run after creating the empty GitHub repository:

```bash
git remote add origin https://github.com/YOUR_USERNAME/peerconnect.git
git branch -M main
git push -u origin main
```

If `origin` already exists, update it instead:

```bash
git remote set-url origin https://github.com/YOUR_USERNAME/peerconnect.git
git push -u origin main
```
