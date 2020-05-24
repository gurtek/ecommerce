create view product_attribute_view as
SELECT
    p.*,
    a.name AS attribute_name,
    a.id AS attribute_id,
    av.attribute_value,
    pa.price AS attribute_price,
    pa.attribute_id
FROM
    products p
JOIN product_attributes pa ON
    p.id = pa.product_id
JOIN attribute_values av ON
    pa.attribute_value_id = av.id
JOIN attributes a ON
    av.attribute_id = a.id;

create view product_categories_view as 
select pc.*, c.category_name from product_categories pc
join categories c on pc.category_id = c.id;

 