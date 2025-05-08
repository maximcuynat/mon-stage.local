# 🚧 1. Travailler dans dev

Tu bosses ici, tu commits, tu pushes.

```bash
git checkout dev
git pull origin dev

# ... tu fais tes changements

git add .
git commit -m "feat: ajout de la nouvelle fonctionnalité"
git push origin dev
```

# 🔬 2. Appliquer un patch/test dans test
Quand tu veux tester des trucs précis ou passer à l’étape suivante QA :
```bash
git checkout test
git pull origin test
git merge dev
git push origin test
```

💡 Tu peux aussi cherry-pick un seul commit de dev si tu veux tester un patch sans tout fusionner :
```bash
git checkout test
git cherry-pick <hash_commit_de_dev>
git push origin test
```

# 🚀 3. Publier en main (release stable)
Quand les tests sont validés, tu veux pousser la version vers la branche stable :
```bash
git checkout main
git pull origin main
git merge test
git push origin main
```

💡 Tu peux ensuite tagger une release :
```bash
git tag v1.2.3
git push origin v1.2.3
```