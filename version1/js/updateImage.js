  let i = 0;
  const $image = $('#images');
  const $demo = $('#demo');
  const updateImage = () => {
    $image.prop('src', '../uploads/' + arr[i]);
    $demo.text('Image ' + (i + 1) + ' of ' + arr.length);
  };
  updateImage();
  $('[data-select]').on('click', e => {
    const towards = $(e.currentTarget).attr('data-select');
    i = (towards === 'left') ? (i === 0 ? arr.length - 1 : i - 1) : (i === arr.length - 1 ? 0 : i + 1);
    updateImage();
  });