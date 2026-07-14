# Container Queries

Sempre considerar antes de Media Queries.

Exemplo:

```css
.card{container-type:inline-size;}

@container (width > 32rem){
  .card__content{
    grid-template-columns:10rem 1fr;
  }
}
```
