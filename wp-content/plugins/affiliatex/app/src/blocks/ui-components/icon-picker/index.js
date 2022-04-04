import { useEffect, useState } from "@wordpress/element";

export default ({ value, label, icons, enableSearch, onChange }) => {

	const [filterText, setFilterText] = useState('');
	const [iconsData, setIconsData] = useState(icons || []);

	useEffect(() => {
		if (enableSearch && filterText.length >= 2) {
			const filteredData = icons.filter(item =>
				item.name.toLowerCase().search(filterText.toLowerCase()) !== -1
			)
			setIconsData(filteredData);
		} else {
			setIconsData(icons)
		}
	}, [filterText])

	return (
		<div className="affiliatex-field affiliatex-field-icon-list affiliatex-field-icon-list-selector">

			{label && <label>{label}</label>}

			<div className="affiliatex-icon-list-wrapper">

				{enableSearch && <input type="text" value={filterText} placeholder="Search..." onChange={e => setFilterText(e.target.value)} autoComplete="off" />}

				<div className="affiliatex-icon-list-icons">
					{iconsData.map(item => {
						return (
							<span className={value == item ? 'affiliatex-active' : ''} onClick={() => onChange(item)}>
								<span className={item.value} />
							</span>
						)
					})}
				</div>
			</div>
		</div>
	)
}
